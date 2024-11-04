<script>
    import { Link } from "@inertiajs/svelte";

    import Fa from "svelte-fa";
    import {
        faArrowLeft,
        faArrowRight,
    } from "@fortawesome/free-solid-svg-icons";

    export let data;
</script>

<div class="mt-6">
    <div class="flex justify-between gap-4">
        {#if data.prev_page_url}
            <Link
                href={data.prev_page_url}
                class="px-3 py-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90"
                ><Fa icon={faArrowLeft} /></Link
            >
        {:else}
            <button
                class="px-3 py-2 border border-zinc-700 rounded-lg bg-zinc-800 text-sm text-white/70 cursor-default"
                ><Fa icon={faArrowLeft} /></button
            >
        {/if}

        {#if data.next_page_url}
            <Link
                href={data.next_page_url}
                class="px-3 py-2 border border-zinc-600 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90"
                ><Fa icon={faArrowRight} /></Link
            >
        {:else}
            <button
                class="px-3 py-2 border border-zinc-700 rounded-lg bg-zinc-800 text-sm text-white/70 cursor-default"
                ><Fa icon={faArrowRight} /></button
            >
        {/if}
    </div>
</div>
