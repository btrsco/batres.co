<template>
    <inertia-head :title="title">
        <meta
            head-key="description"
            name="description"
            :content="application.meta.description"
        />

        <meta
            head-key="og:type"
            property="og:type"
            :content="application.meta.type"
        />

        <meta
            head-key="og:title"
            property="og:title"
            :content="application.meta.title.default"
        />

        <meta
            head-key="og:description"
            property="og:description"
            :content="application.meta.description"
        />

        <meta
            head-key="og:site_name"
            property="og:site_name"
            :content="application.name"
        />

        <meta
            head-key="og:image"
            property="og:image"
            :content="application.meta.image"
        />

        <meta
            head-key="twitter:card"
            property="twitter:card"
            :content="application.meta.twitter_card"
        />

        <meta
            head-key="twitter:title"
            property="twitter:title"
            :content="application.name"
        />

        <meta
            head-key="twitter:description"
            property="twitter:description"
            :content="application.meta.description"
        />

        <meta
            head-key="twitter:site"
            property="twitter:site"
            :content="application.social.twitter.at"
        />

        <meta
            head-key="twitter:image"
            property="twitter:image"
            :content="application.meta.image"
        />

        <meta
            head-key="theme-color:light"
            name="theme-color"
            :content="application.meta.theme.light"
            media="(prefers-color-scheme: light)"
        />

        <meta
            head-key="theme-color:dark"
            name="theme-color"
            :content="application.meta.theme.dark"
            media="(prefers-color-scheme: dark)"
        />

        <link
            head-key="favicon-32"
            rel="icon"
            href="/favicon-32.png"
            sizes="32x32"
        />

        <link
            head-key="favicon-128"
            rel="icon"
            href="/favicon-128.png"
            sizes="128x128"
        />

        <link
            head-key="favicon-180"
            rel="icon"
            href="/favicon-180.png"
            sizes="180x180"
        />

        <link
            head-key="favicon-192"
            rel="icon"
            href="/favicon-192.png"
            sizes="192x192"
        />

        <slot />
    </inertia-head>
</template>

<script>
export default {
    name:  'PageHead',
    props: {
        title:  { type: String, required: false },
        app:    { type: Object, required: false },
    },
    data() {
        return {
            application: this.app ?? this.$page.props.app,
        };
    },
};
</script>
