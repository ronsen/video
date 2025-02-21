<script module>
    export { default as layout } from "./Layouts/App.svelte";
</script>

<script>
    import Posts from "./Components/Posts.svelte";

    let { posts } = $props();
</script>

<svelte:head>
    <title>Social Video Bookmarking</title>
</svelte:head>

<Posts {posts} showUser={true} />
