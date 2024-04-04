<meta
    inertia
    head-key="description"
    name="description"
    content="{{ $page['props']['app']['meta']['description'] }}"
/>

<meta
    inertia
    head-key="og:type"
    property="og:type"
    content="{{ $page['props']['app']['meta']['type'] }}"
/>

<meta
    inertia
    head-key="og:title"
    property="og:title"
    content="{{ $page['props']['app']['meta']['title']['default'] }}"
/>

<meta
    inertia
    head-key="og:description"
    property="og:description"
    content="{{ $page['props']['app']['meta']['description'] }}"
/>

<meta
    inertia
    head-key="og:site_name"
    property="og:site_name"
    content="{{ $page['props']['app']['name'] }}"
/>

<meta
    inertia
    head-key="og:image"
    property="og:image"
    content="{{ $page['props']['app']['meta']['image'] }}"
/>

<meta
    inertia
    head-key="twitter:card"
    property="twitter:card"
    content="{{ $page['props']['app']['meta']['twitter_card'] }}"
/>

<meta
    inertia
    head-key="twitter:title"
    property="twitter:title"
    content="{{ $page['props']['app']['name'] }}"
/>

<meta
    inertia
    head-key="twitter:description"
    property="twitter:description"
    content="{{ $page['props']['app']['meta']['description'] }}"
/>

<meta
    inertia
    head-key="twitter:site"
    property="twitter:site"
    content="{{ $page['props']['app']['social']['twitter']['at'] }}"
/>

<meta
    inertia
    head-key="twitter:image"
    property="twitter:image"
    content="{{ $page['props']['app']['meta']['image'] }}"
/>

<meta
    inertia
    head-key="theme-color:light"
    name="theme-color"
    content="{{ $page['props']['app']['meta']['theme']['light'] }}"
    media="(prefers-color-scheme: light)"
/>

<meta
    inertia
    head-key="theme-color:dark"
    name="theme-color"
    content="{{ $page['props']['app']['meta']['theme']['dark'] }}"
    media="(prefers-color-scheme: dark)"
/>
