<script lang="ts">
	import { Link } from "@inertiajs/svelte";
	import type { Category, Post } from "@/types";
	import App from "../Layouts/App.svelte";
	import Posts from "../Components/Posts.svelte";

	interface Props {
		posts: {
			data: Post[];
			prev_page_url: string;
			next_page_url: string;
		};
		category: Category;
	}

	let { posts, category }: Props = $props();
</script>

<svelte:head>
	<title>{category.name}</title>
</svelte:head>

<App>
	<div class="my-4 px-6">
		<h3 class="font-bold mb-6 border-b border-zinc-600 gap-3 pb-2">
			<Link href="/category/{category.slug}">{category.name}</Link>
		</h3>

		<Posts {posts} showUser={true} />
	</div>
</App>
