<script lang="ts">
	import { page, Link, inertia } from "@inertiajs/svelte";
	import {
		CirclePlus,
		Code,
		LogIn,
		LogOut,
		User,
		Menu,
		X,
	} from "@lucide/svelte";
	import type { Snippet } from "svelte";
	import Alert from "@/components/Alert.svelte";
	import Categories from "@/components/Categories.svelte";
	import Search from "@/components/Search.svelte";
	import type { Category } from "@/types";
	import { fly } from "svelte/transition";

	let {
		children,
		categories,
		q,
	}: { children: Snippet; categories: Category[]; q?: string } = $props();

	let show = $state(false);

	function showMenu() {
		show = !show;
	}
</script>

<nav
	class="flex gap-4 justify-between items-center border-b border-zinc-600 px-6 py-2 bg-zinc-800"
>
	<div class="flex md:flex-1 items-center gap-2">
		<button class="cursor-pointer" onclick={showMenu}
			><Menu size={16} /></button
		>
		<Link href="/"
			><img src="/icon-512.png" alt="Video" class="w-6 h-6" /></Link
		>
	</div>

	<div class="flex-1">
		<Search {q} />
	</div>

	<div class="flex md:flex-1 justify-end">
		<div class="inline-flex gap-3">
			{#if $page.props.auth.user}
				<Link
					href="/posts/create"
					class="text-zinc-400 hover:text-zinc-300"
					><CirclePlus size={16} /></Link
				>
				<Link
					href="/user/{$page.props.auth.user.id}/{$page.props.auth
						.user.slug}"
					class="text-zinc-400 hover:text-zinc-300"
					><User size={16} /></Link
				>
				<button
					use:inertia={{ href: "/logout", method: "post" }}
					class="text-zinc-400 hover:text-zinc-300 cursor-pointer"
					><LogOut size={16} /></button
				>
			{/if}

			{#if !$page.props.auth.user}
				<Link href="/login" class="text-zinc-400 hover:text-zinc-300"
					><LogIn size={16} /></Link
				>
			{/if}
		</div>
	</div>
</nav>

<main class="container mx-auto mb-8">
	{#if $page.props.flash}
		<Alert>{@html $page.props.flash}</Alert>
	{/if}

	{@render children()}
</main>

<footer
	class="py-4 bg-zinc-900/90 w-full flex justify-center border-t border-zinc-800 container mx-auto"
>
	<a href="https://github.com/ronsen/video" target="_blank"
		><Code size={16} /></a
	>
</footer>

{#if show}
	<div
		transition:fly={{ x: -200, duration: 50, easing: t => t*t }}
		class="fixed h-screen top-0 left-0 bg-zinc-800 shadow w-full md:w-md z-10"
	>
		<div class="flex justify-end p-4">
			<button class="cursor-pointer" onclick={showMenu}><X /></button>
		</div>
		<Categories {categories} />
	</div>
{/if}
