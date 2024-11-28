<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { page } from "@inertiajs/svelte";
    import Posts from "../Components/Posts.svelte";
    import Search from "../Components/Search.svelte";

    let { posts, q } = $props();
</script>

<svelte:head>
    <title>{$page.props.appName}</title>
</svelte:head>

<section class="mb-6">
	<Search {q} />
</section>

<Posts {posts} />
