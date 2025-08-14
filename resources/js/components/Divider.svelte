<script lang="ts">
	let { text }: { text: string } = $props();
</script>

<div class="my-4 flex items-center text-sm">
	<div class="grow border-t border-zinc-700"></div>
	<span class="mx-4 text-white/90">{text}</span>
	<div class="grow border-t border-zinc-700"></div>
</div>
