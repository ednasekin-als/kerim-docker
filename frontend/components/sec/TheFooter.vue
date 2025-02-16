<template>
    <footer class="footer">
        <div class="footer__copyright">
            <p class="p1">Copyright © 2025 Kerimov Architects. All rights reserved.</p>
        </div>
    </footer>
</template>
<style scoped lang="scss">
.socWrap {
    display: flex;
    flex-wrap: wrap;
    gap: 0 1rem;
}

.footer {
    padding: var(--main-pad);
    color: #282828;

    &__copyright {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.16);

        p {
            font-size: 14px;
            opacity: 0.5;
        }
    }

}

.footerLogo {
    display: inline-block;

    svg {
        height: 3rem;
        width: auto;
    }
}
</style>
