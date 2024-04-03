import {Head, Link} from '@inertiajs/vue3';

export default {
  install: function (app) {
    registerComponents(app, {
      'inertia-link': Link,
      'inertia-head': Head,
    });
  },
};

function registerComponents(app, components) {
  for (const [name, component] of Object.entries(components)) {
    app.component(name, component);
  }
}
