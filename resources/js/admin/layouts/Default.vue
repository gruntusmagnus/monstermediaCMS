<template>
    <div class="page page--admin">
        <header class="header header--admin">
            <div class="header__logo">
                <a href="/admin">
                    <img src="/img/logo.png" alt="Cyberbog">
                </a>
            </div>
            <top-navigation></top-navigation>
        </header>
        <main class="content">
            <div class="container-fluid">
                <router-view></router-view>
            </div>
        </main>
        <footer class="footer footer--admin">
            <bot-navigation></bot-navigation>
        </footer>
    </div>
</template>

<script>
	import TopNavigation from "../components/layout/TopNavigation";
	import BotNavigation from "../components/layout/BotNavigation";

	export default {
		components: {
			TopNavigation,
			BotNavigation
		}
	}
</script>
