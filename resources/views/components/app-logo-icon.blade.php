<div
    x-data="{ dark: document.documentElement.classList.contains('dark') }"
    x-init="
        const observer = new MutationObserver(() => {
            dark = document.documentElement.classList.contains('dark')
        })
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] })
    "
    >
        <div class="flex items-center gap-2">
            <img x-show="!dark" x-cloak class="w-8 h-auto" src="/images/ai-logo-light.svg" alt="">
            <img x-show="dark" x-cloak class="w-8 h-auto" src="/images/ai-logo-dark.svg" alt="">
            <span class="text-md font-bold">NEURA</span>
        </div>
</div>
