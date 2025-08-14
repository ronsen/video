<script lang="ts">
	import type { Snippet } from "svelte";

	let { children }: { children: Snippet } = $props();
</script>

<main class="flex items-center justify-center h-screen">
	{@render children()}
</main>
