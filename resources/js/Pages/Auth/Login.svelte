<script context="module">
    export { default as layout } from "../Layouts/App.svelte";
</script>

<script>
    import { useForm } from "@inertiajs/svelte";

    let form = useForm({
        email: "",
        password: "",
    });

    function submit() {
        $form.post("/login", {
            onSubmit: () => $form.reset("password"),
        });
    }
</script>

<svelte:head>
    <title>Log In</title>
</svelte:head>

<div class="mb-6">
    <form on:submit|preventDefault={submit}>
        <div class="mb-3">
            <!-- svelte-ignore a11y-autofocus -->
            <input
                type="email"
                bind:value={$form.email}
                placeholder="E-mail"
                class="p-2 border border-zinc-500 rounded-lg bg-zinc-900 text-white/90 w-full"
                autofocus
            />
            {#if $form.errors.email}
                <div class="text-error text-sm font-bold mt-1">
                    {$form.errors.email}
                </div>
            {/if}
        </div>
        <div class="mb-3">
            <input
                type="password"
                bind:value={$form.password}
                placeholder="Password"
                class="p-2 border border-zinc-500 rounded-lg bg-zinc-900 text-white/90 w-full"
            />
            {#if $form.errors.password}
                <div class="text-error text-sm font-bold mt-1">
                    {$form.errors.password}
                </div>
            {/if}
        </div>
        <button
            type="submit"
            class="p-2 border border-zinc-500 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-sm text-white/90 w-full"
            disabled={$form.processing}>Log In</button
        >
    </form>
</div>

<div class="text-center text-sm">Sign in or register</div>

<div class="flex justify-center py-3">
    <a href="/oauth"
        ><img src="./google-signin.png" alt="[]" class="w-full md:w-56" /></a
    >
</div>
