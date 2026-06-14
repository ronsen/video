<script lang="ts">
	import { Form } from "@inertiajs/svelte";
	import Divider from "@/components/Divider.svelte";
	import Guest from "@/layouts/Guest.svelte";

	let { title }: { title: string } = $props();
</script>

<svelte:head>
	<title>{title}</title>
</svelte:head>

<Guest>
	<div class="container md:w-[400px] mx-auto p-4">
		<div class="mb-6">
			<div class="flex justify-center mb-6">
				<a href="/"
					><img
						src="/icon-512.png"
						alt="Video"
						class="w-12 h-12"
					/></a
				>
			</div>

			<Form action="/login" method="post" disableWhileProcessing>
				{#snippet children({ errors, processing })}
					<div class="mb-3">
						<input
							type="email"
							name="email"
							placeholder="E-mail"
							class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
						/>
						{#if errors.email}
							<div class="text-red-500 text-xs mt-1">
								{errors.email}
							</div>
						{/if}
					</div>
					<div class="mb-3">
						<input
							type="password"
							name="password"
							placeholder="Password"
							class="border border-zinc-600 rounded-lg bg-zinc-800 text-white/90 w-full"
						/>
						{#if errors.password}
							<div class="text-red-500 text-xs mt-1">
								{errors.password}
							</div>
						{/if}
					</div>
					<button
						type="submit"
						class="p-2 font-semibold border border-zinc-200 rounded-full bg-zinc-200 hover:bg-zinc-100 text-sm text-black/90 w-full"
						disabled={processing}>Log In</button
					>
				{/snippet}
			</Form>
		</div>

		<Divider text="Sign in or register" />

		<div class="flex justify-center">
			<a href="/oauth"
				><img src="./google-signin.png" alt="[]" class="w-56" /></a
			>
		</div>
	</div>
</Guest>
