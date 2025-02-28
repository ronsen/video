<script>
	import { Info, X } from "lucide-svelte";

	let { children } = $props();

	let show = $state(true);

	function close(e) {
		e.preventDefault();
		show = !show;
	}
</script>

{#if show}
	<div
		class="flex justify-between items-center shadow-lg border border-zinc-500 p-4 rounded-lg my-6"
	>
		<div class="inline-flex items-center gap-2">
			<Info size={16} />
			{@render children()}
		</div>
		<span></span>
		<button onclick={close}><X size={16} /></button>
	</div>
{/if}
