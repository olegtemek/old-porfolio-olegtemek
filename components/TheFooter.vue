<template>
  <footer class="footer">
    <div class="container">
      <div class="footer__wrapper">
        <a
          href="https://github.com/olegtemek"
          target="_blank"
          class="footer__item"
          >GitHub</a
        >
        <a href="https://t.me/olegtemek" target="_blank" class="footer__item"
          >Telegram</a
        >
        <a
          href="mailto:olegtemek@gamil.com"
          target="_blank"
          class="footer__item"
          >olegtemek@gmail.com</a
        >
        <a
          href="https://instagram.com/o1eg0609"
          target="_blank"
          class="footer__item"
          >Instagram</a
        >
      </div>
    </div>
  </footer>
</template>

<style lang="scss">
.footer {
  padding-bottom: 40px;
  &__wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    @media (max-width: 600px) {
      gap: 20px;
      flex-wrap: wrap;
      justify-content: center;
    }
  }
  &__item {
    font-size: 24px;
  }
}
</style>