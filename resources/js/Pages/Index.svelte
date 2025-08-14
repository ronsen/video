<script lang="ts">
	import type { Category, Post } from "@/types";
	import App from "./Layouts/App.svelte";
	import Categories from "./Components/Categories.svelte";
	import Posts from "./Components/Posts.svelte";

	interface Props {
		posts: {
			data: Post[];
			prev_page_url: string;
			next_page_url: string;
		};
		categories: Category[];
	}

	let { posts, categories }: Props = $props();
</script>

<svelte:head>
	<title>Social Video Bookmarking</title>
</svelte:head>

<App>
	<div class="my-4 px-6">
		<Categories {categories} />

		<Posts {posts} showUser={true} />
	</div>
</App>
