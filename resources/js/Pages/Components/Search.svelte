<script>
	import { useForm } from "@inertiajs/svelte";
	import { Search } from "@lucide/svelte";

	let { q } = $props();

	let form = useForm({
		q,
	});

	function submit(e) {
		e.preventDefault();
		$form.get("/search");
	}
</script>

<div class="relative">
	<form onsubmit={submit}>
		<div class="inline-flex w-full">
			<div
				class="absolute px-3 p-2.5 top-0 left-0 text-sm text-white/90 hover:text-white"
			>
				<Search size={16} />
			</div>
			<input
				type="search"
				bind:value={$form.q}
				class="px-8 py-1 border border-zinc-600 bg-zinc-800 rounded-full text-white/90 w-full"
				required
			/>
		</div>
	</form>
</div>
