<script>
    import Fa from "svelte-fa";
    import { faCircleInfo, faXmark } from "@fortawesome/free-solid-svg-icons";

    let { children } = $props();

    let show = $state(true);

    function close(e) {
        e.preventDefault();
        show = !show;
    }
</script>

{#if show}
    <div
        class="flex justify-between items-center shadow-lg border border-zinc-500 p-4 rounded-lg mb-6"
    >
        <div class="inline-flex items-center gap-2">
            <Fa icon={faCircleInfo} />
            {@render children()}
        </div>
        <span></span>
        <button onclick={close}><Fa icon={faXmark} /></button>
    </div>
{/if}
