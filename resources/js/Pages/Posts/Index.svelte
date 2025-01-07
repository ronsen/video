<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { page } from "@inertiajs/svelte";
    import Posts from "../Components/Posts.svelte";  

    let { posts } = $props();
</script>

<svelte:head>
    <title>{$page.props.appName}</title>
</svelte:head>
<Posts {posts} />
