<script>
	import { Link } from "@inertiajs/svelte";
	import { MoveLeft, MoveRight } from "@lucide/svelte";

	let { data } = $props();
</script>

<div class="mt-6">
	<div class="flex justify-between gap-4">
		{#if data.prev_page_url}
			<Link
				href={data.prev_page_url}
				class="px-3 py-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90"
				><MoveLeft size={16} /></Link
			>
		{:else}
			<button
				class="px-3 py-2 border border-zinc-700 rounded-lg bg-zinc-800 text-sm text-white/20 cursor-default"
				><MoveLeft size={16} /></button
			>
		{/if}

		{#if data.next_page_url}
			<Link
				href={data.next_page_url}
				class="px-3 py-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90"
				><MoveRight size={16} /></Link
			>
		{:else}
			<button
				class="px-3 py-2 border border-zinc-700 rounded-lg bg-zinc-800 text-sm text-white/20 cursor-default"
				><MoveRight size={16} /></button
			>
		{/if}
	</div>
</div>
