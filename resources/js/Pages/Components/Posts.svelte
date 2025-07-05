<script>
	import { Link } from "@inertiajs/svelte";
	import { Lock } from "@lucide/svelte";
	import Alert from "../Components/Alert.svelte";
	import Pagination from "../Components/Pagination.svelte";

	let { posts, showUser } = $props();
</script>

{#if posts.data.length == 0}
	<Alert>Empty.</Alert>
{:else}
	<div class="grid md:grid-cols-3 gap-4">
		{#each posts.data as post}
			<div>
				<Link href="/v/{post.id}/{post.slug}"
					><img
						src={post.thumbnail_url}
						alt={post.title}
						class="w-full rounded-lg object-cover"
					/>
				</Link>
				<div class="mt-1">
					<div class="inline-flex items-baseline gap-1 font-bold">
						{#if post.private}
							<Lock size={16} />
						{/if}
						<Link href="/v/{post.id}/{post.slug}">{post.title}</Link
						>
					</div>
					{#if showUser}
						<div class="text-sm">
							<Link href="/user/{post.user.id}/{post.user.slug}"
								>{post.user.name}</Link
							>
						</div>
					{/if}
				</div>
			</div>
		{/each}
	</div>

	<Pagination data={posts} />
{/if}
