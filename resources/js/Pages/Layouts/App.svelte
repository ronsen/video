<script>
    import { page, Link, inertia } from "@inertiajs/svelte";
    import Alert from "../Components/Alert.svelte";
    import Search from "../Components/Search.svelte";

    import Fa from "svelte-fa";
    import {
        faPlusCircle,
        faRightFromBracket,
        faRightToBracket,
    } from "@fortawesome/free-solid-svg-icons";
    import { faGithub } from "@fortawesome/free-brands-svg-icons";

    let { children, q } = $props();
</script>

<nav
    class="flex justify-between items-center border-b border-zinc-600 px-6 py-2 bg-zinc-800"
>
    <div class="flex-1">
        <Link href="/"
            ><img src="/icon-512.png" alt="Video" class="w-6 h-6" /></Link
        >
    </div>

    <div class="flex-1">
        <Search {q} />
    </div>

    <div class="flex-1 text-end">
        <div class="inline-flex gap-3">
            {#if $page.props.auth.user}
                <Link
                    href="/posts/create"
                    class="text-zinc-400 hover:text-zinc-300"
                    ><Fa icon={faPlusCircle} /></Link
                >
                <button
                    use:inertia={{ href: "/logout", method: "post" }}
                    class="text-zinc-400 hover:text-zinc-300"
                    ><Fa icon={faRightFromBracket} /></button
                >
            {/if}

            {#if !$page.props.auth.user}
                <Link href="/login" class="text-zinc-400 hover:text-zinc-300"
                    ><Fa icon={faRightToBracket} /></Link
                >
            {/if}
        </div>
    </div>
</nav>

<main class="container mx-auto my-4 px-6 mb-16">
    {#if $page.props.flash.message}
        <Alert>{@html $page.props.flash.message}</Alert>
    {/if}

    {@render children()}
</main>

<footer
    class="fixed bottom-0 left-1/2 -translate-x-1/2 py-4 bg-zinc-900/90 w-full flex justify-center"
>
    <a href="https://github.com/ronsen/video" target="_blank"
        ><Fa icon={faGithub} /></a
    >
</footer>
