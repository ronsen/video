<script lang="ts">
	import { Link } from "@inertiajs/svelte";
	import { House } from "@lucide/svelte";
	import type { Category } from "@/types";

	let { categories }: { categories: Category[] } = $props();
</script>

<ul>
	<li class="px-6 py-2 hover:bg-zinc-900">
		<Link href="/"><House size={16} /></Link>
	</li>
	{#each categories as category}
		<li class="px-6 py-2 hover:bg-zinc-900">
			<Link href="/category/{category.slug}" class="text-nowrap block"
				>{category.name}</Link
			>
		</li>
	{/each}
</ul>
