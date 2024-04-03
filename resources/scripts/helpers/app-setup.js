import Axios from '@/scripts/plugins/axios';
import Components from '@/scripts/plugins/components';
import dayjs from 'dayjs';
import timezone from 'dayjs/plugin/timezone';
import utc from 'dayjs/plugin/utc';
import PortalVue from 'portal-vue';
import { createApp, createSSRApp, h } from 'vue';
import Vue3Marquee from "vue3-marquee";

/* Setup inertia app and helpers.
 * - - - - - - - - - - - - - - - - - - */

dayjs.extend(utc);
dayjs.extend(timezone);
dayjs.tz.setDefault('MST');

export default function ({ el, App, props, plugin, page }) {
  /* Initialize vue app.
   * - - - - - - - - - - - - - - - - - - */

  let vueApp = page !== undefined
    ? createSSRApp({ render: () => h(App, props) })
    : createApp({ render: () => h(App, props) });

  /* Instantiate helpers and mixins.
   * - - - - - - - - - - - - - - - - - - */

  vueApp.mixin({
    methods: { dayjs },
  });

  /* Instantiate global plugins.
   * - - - - - - - - - - - - - - - - - - */

  vueApp.use(PortalVue);
  vueApp.use(Vue3Marquee);
  vueApp.use(Axios);
  vueApp.use(Components);
  vueApp.use(plugin);

  /* Mount app to element and window.
   * - - - - - - - - - - - - - - - - - - */

  if (el) vueApp.mount(el);

  return vueApp;
}
