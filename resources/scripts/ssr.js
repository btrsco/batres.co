import '@/scss/app.scss';

import { renderToString } from '@vue/server-renderer';
import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import appSetup from '@/scripts/helpers/app-setup';

const appName = import.meta.env.VITE_APP_NAME;

createServer((page) =>
  createInertiaApp({
    page,
    render: renderToString,
    title: (title) => `${ title } - ${ appName }`,
    resolve: (name) => resolvePageComponent(
      `/resources/views/pages/${ name }.vue`,
      import.meta.glob('/resources/views/pages/**/*.vue'),
    ),
    setup: ({ App, props, plugin }) => appSetup({ App, props, plugin, page }),
    progress: { color: '#4b5563' },
  }),
);
