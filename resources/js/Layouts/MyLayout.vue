<template>
    <header>
        <nav>NAV</nav>
        <div v-if="$slots.tittle" class="bg-green-200">
            <slot name="tittle"/>
        </div>
    </header>
    <div class="bg-gray-200">
        <slot />
    </div>
</template>