<script>
    import { router } from "@inertiajs/svelte";

    import Fa from "svelte-fa";
    import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";

    let { post } = $props();

    let dialog;

    function close(e) {
        e.preventDefault();
        dialog.close();
    }

    function submit(e) {
        e.preventDefault();
        router.delete(`/posts/${post.id}`);
        dialog.close();
    }
</script>

<button
    type="button"
    class="text-zinc-400 cursor-pointer"
    onclick={() => dialog.showModal()}><Fa icon={faTrashAlt} /></button
>

<dialog
    bind:this={dialog}
    class="w-full m-auto md:w-1/3 border border-zinc-100 dark:border-zinc-600 rounded-lg shadow-sm dark:bg-zinc-900 dark:text-white/90 bg-zinc-50 backdrop:backdrop-blur-sm"
>
    <form onsubmit={submit}>
        <div class="p-6">
            <p>Delete this video?</p>
        </div>

        <div class="flex justify-end gap-3 p-3 bg-zinc-100 dark:bg-zinc-800">
            <div class="flex justify-between gap-4">
                <button
                    class="p-2 border border-zinc-500 rounded-lg text-sm"
                    onclick={close}>No</button
                >
                <button
                    type="submit"
                    class="p-2 border border-red-500 bg-red-500 rounded-lg text-sm"
                    >Yes</button
                >
            </div>
        </div>
    </form>
</dialog>
