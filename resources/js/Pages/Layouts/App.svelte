<script>
    import { page, Link, inertia } from "@inertiajs/svelte";
    import Alert from "../Components/Alert.svelte";

    import Fa from "svelte-fa";
    import {
        faPlus,
        faRightFromBracket,
        faRightToBracket,
    } from "@fortawesome/free-solid-svg-icons";
    import { faGithub } from "@fortawesome/free-brands-svg-icons";

	let { children } = $props();
</script>

<main class="container mx-auto md:w-[720px] my-6 px-6 md:my-12">
    <nav
        class="flex justify-between items-center border-b border-zinc-500 pb-2 mb-8"
    >
        <h1 class="font-bold">
            <Link href="/">{$page.props.appName}</Link>
        </h1>

        <div class="inline-flex gap-3">
            {#if $page.props.auth.user}
                <Link
                    href="/posts/create"
                    class="text-zinc-400 hover:text-zinc-300"
                    ><Fa icon={faPlus} /></Link
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
    </nav>

    {#if $page.props.flash.message}
        <Alert>{@html $page.props.flash.message}</Alert>
    {/if}

    {@render children()}
</main>

<footer class="absolute bottom-0 left-1/2 -translate-x-1/2 py-4">
    <a href="https://github.com/ronsen/video" target="_blank"
        ><Fa icon={faGithub} /></a
    >
</footer>
