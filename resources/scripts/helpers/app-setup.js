import Axios from '@/scripts/plugins/axios';
import Components from '@/scripts/plugins/components';
import dayjs from 'dayjs';
import timezone from 'dayjs/plugin/timezone';
import utc from 'dayjs/plugin/utc';
import PortalVue from 'portal-vue';
import { createApp, createSSRApp, h } from 'vue';
import { ZiggyVue } from 'ZiggyVue';

/* Setup inertia app and helpers.
 * - - - - - - - - - - - - - - - - - - */

dayjs.extend(utc);
dayjs.extend(timezone);

export default function ({ el, App, props, plugin, page }) {
  /* Initialize vue app.
   * - - - - - - - - - - - - - - - - - - */

  let vueApp = page !== undefined
    ? createSSRApp({ render: () => h(App, props) })
    : createApp({ render: () => h(App, props) });

  /* Instantiate helpers and mixins.
   * - - - - - - - - - - - - - - - - - - */

  vueApp.mixin({
    methods: { __, dayjs },
  });

  /* Instantiate global plugins.
   * - - - - - - - - - - - - - - - - - - */

  vueApp.use(ZiggyVue, page !== undefined ? {
      ...page.props.ziggy,
      url: new URL(page.props.ziggy.location),
    } : Ziggy,
  );

  vueApp.use(PortalVue);
  vueApp.use(Axios);
  vueApp.use(Components);
  vueApp.use(plugin);

  /* Mount app to element and window.
   * - - - - - - - - - - - - - - - - - - */

  if (el) vueApp.mount(el);

  return vueApp;
}
