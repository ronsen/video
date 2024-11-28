<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
	import Posts from "../Components/Posts.svelte";

    let { posts, slug } = $props();
</script>

<svelte:head>
    <title>{slug}</title>
</svelte:head>

<h3 class="font-bold mb-6 border-b border-zinc-600 gap-3 pb-2">
    <a href="/tag/{slug}">{slug}</a>
</h3>

<Posts {posts} />