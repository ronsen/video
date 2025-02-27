<script>
    import { page, Link, inertia } from "@inertiajs/svelte";
	import { CirclePlus, Code, LogIn, LogOut, User } from "lucide-svelte";
    import Alert from "../Components/Alert.svelte";
    import Search from "../Components/Search.svelte";

    let { children, q } = $props();
</script>

<nav
    class="flex gap-4 justify-between items-center border-b border-zinc-600 px-6 py-2 bg-zinc-800"
>
    <div class="flex md:flex-1">
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

<main class="container mx-auto mb-16">
    {#if $page.props.flash.message}
        <Alert>{@html $page.props.flash.message}</Alert>
    {/if}

    {@render children()}
</main>

<footer
    class="fixed bottom-0 left-1/2 -translate-x-1/2 py-4 bg-zinc-900/90 w-full flex justify-center"
>
    <a href="https://github.com/ronsen/video" target="_blank"
        ><Code size={16} /></a
    >
</footer>
