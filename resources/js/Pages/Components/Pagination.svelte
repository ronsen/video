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
            <Link href={data.prev_page_url}><Fa icon={faArrowLeft} /></Link>
        {:else}
            <button class="disabled cursor-default"><Fa icon={faArrowLeft} /></button>
        {/if}

        {#if data.next_page_url}
            <Link href={data.next_page_url}><Fa icon={faArrowRight} /></Link>
        {:else}
            <button class="disabled cursor-default"><Fa icon={faArrowRight} /></button>
        {/if}
    </div>
</div>
