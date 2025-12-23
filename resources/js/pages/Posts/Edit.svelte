<script lang="ts">
	import { useForm } from "@inertiajs/svelte";
	import { Info } from "@lucide/svelte";
	import App from "@/layouts/App.svelte";
	import type { Category, Post } from "@/types";

	let { post, categories }: { post: Post; categories: Category[] } = $props();

	let form = useForm({
		url: '',
		title: '',
		content: '',
		private: false,
		category: 0 as number,
	});

	$effect(() => {
		$form.url = post.url;
		$form.title = post.title;
		$form.content = post.content;
		$form.private = post.private;
		$form.category = post.category ?? 0;
	});

	function submit(e: SubmitEvent) {
		e.preventDefault();
		$form.patch("/posts/" + post.id);
	}
</script>

<svelte:head>
	<title>Edit Video</title>
</svelte:head>

<App {categories}>
	<div class="my-4 px-6">
		<div class="md:max-w-2xl md:mx-auto">
			<form onsubmit={submit}>
				<div class="mb-3">
					<input
						type="url"
						bind:value={$form.url}
						placeholder="URL"
						class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
					/>
					<div
						class="mt-1 text-xs text-gray-400 flex items-center gap-1"
					>
						<Info size={16} />
						<span>Only supports YouTube</span>
					</div>
					{#if $form.errors.url}
						<div class="text-error text-sm font-bold mt-1">
							{$form.errors.url}
						</div>
					{/if}
				</div>
				<div class="mb-3">
					<input
						type="text"
						bind:value={$form.title}
						placeholder="Title"
						class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
					/>
					{#if $form.errors.title}
						<div class="text-error font-bold text-sm mt-1">
							{$form.errors.title}
						</div>
					{/if}
				</div>
				<div class="mb-3">
					<select
						bind:value={$form.category}
						class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
					>
						{#each categories as category}
							<option value={category.id}>{category.name}</option>
						{/each}
					</select>
					{#if $form.errors.category}
						<div class="text-red-500 text-xs mt-1">
							{$form.errors.category}
						</div>
					{/if}
				</div>
				<div class="mb-3">
					<textarea
						bind:value={$form.content}
						class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full h-40"
					></textarea>
				</div>
				<div class="mb-3">
					<label class="flex justify-start items-center gap-2">
						<input
							type="checkbox"
							bind:checked={$form.private}
							class="border border-zinc-600 rounded bg-zinc-800 text-white/90"
						/>Private
					</label>
				</div>
				<button
					type="submit"
					class="p-2 font-semibold border border-zinc-200 rounded-full bg-zinc-200 hover:bg-zinc-100 text-sm text-black/90 w-full"
					disabled={$form.processing}>Update</button
				>
			</form>
		</div>
	</div>
</App>
