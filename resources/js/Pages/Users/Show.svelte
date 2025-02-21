<script module>
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { Link } from "@inertiajs/svelte";
    import Posts from "../Components/Posts.svelte";

    let { posts, user } = $props();
</script>

<svelte:head>
    <title>{user.name}</title>
</svelte:head>

<h3 class="text-xl font-bold border-b border-zinc-600 pb-3 mb-6">
    <Link href="/user/{user.id}/{user.slug}">{user.name}</Link>
</h3>

<Posts {posts} />
