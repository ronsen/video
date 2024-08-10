<script>
    import { useForm } from "@inertiajs/svelte";

    import Fa from "svelte-fa";
    import { faTrashAlt } from "@fortawesome/free-solid-svg-icons";

    export let post;

    let dialog;
    let form = useForm();

    function destroy() {
        dialog.showModal();
    }

    function submit() {
        $form.delete(`/posts/${post.id}`);
        dialog.close();
    }
</script>

<button class="text-base-300" on:click={() => destroy()}
    ><Fa icon={faTrashAlt} /></button
>

<dialog bind:this={dialog} class="modal">
    <form on:submit|preventDefault={submit} class="modal-box">
        <h3 class="font-bold text-lg">Delete this video?</h3>
        <p class="py-4">{post.title}</p>

        <div class="modal-action">
            <button
                class="btn btn-neutral btn-sm"
                on:click|preventDefault={() => dialog.close()}>No</button
            >
            <button type="submit" class="btn btn-error btn-sm">Yes</button>
        </div>
    </form>
</dialog>
