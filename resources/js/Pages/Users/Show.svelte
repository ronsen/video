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

<div class="my-4 px-6">
	<h3 class="font-bold mb-6 border-b border-zinc-600 gap-3 pb-2">
		<Link href="/user/{user.id}/{user.slug}">{user.name}</Link>
	</h3>

	<Posts {posts} />
</div>
