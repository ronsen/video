<script module>
    export { default as layout } from "./Layouts/App.svelte";
</script>

<script>
    import Categories from "./Components/Categories.svelte";

    import Posts from "./Components/Posts.svelte";

    let { posts, categories, q } = $props();
</script>

<svelte:head>
    <title>{q}</title>
</svelte:head>

<Categories {categories} />

<Posts {posts} showUser={true} />
