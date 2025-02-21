<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { Link } from "@inertiajs/svelte";
    import Posts from "../Components/Posts.svelte";

    let { posts, category } = $props();
</script>

<svelte:head>
    <title>{category.name}</title>
</svelte:head>

<h3 class="font-bold mb-6 border-b border-zinc-600 gap-3 pb-2">
    <Link href="/category/{category.slug}">{category.name}</Link>
</h3>

<Posts {posts} showUser={true} />
