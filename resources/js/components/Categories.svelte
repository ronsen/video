<script lang="ts">
	import { Link } from "@inertiajs/svelte";
	import { House } from "@lucide/svelte";
	import type { Category } from "@/types";

	let { categories }: { categories: Category[] } = $props();
</script>

<div class="overflow-x-auto mb-4">
	<ul class="inline-flex items-center gap-4 mb-2">
		<li><Link href="/"><House size={16} /></Link></li>
		{#each categories as category}
			<li>
				<Link href="/category/{category.slug}" class="text-nowrap"
					>{category.name}</Link
				>
			</li>
		{/each}
	</ul>
</div>
