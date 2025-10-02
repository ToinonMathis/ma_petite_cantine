<template>
  <div
    class="modal modal-custom fade"
    :data-bs-backdrop="backdrop_static"
    :id="id"
    tabindex="-1"
    aria-hidden="true"
  >
    <!--begin::Modal dialog-->
    <div class="modal-dialog" :class="cssClass">
      <!--begin::Modal content-->
      <div class="modal-content">
        <!--begin::Modal header-->
        <div class="modal-header">
          <slot name="header" :title="title">
            <h3>{{ title }}</h3>
            <div
              class="modal-close p-0"
              data-bs-dismiss="modal"
              @click="dismiss"
            >
              <span class="svg-icon">
                <inline-svg src="/media/icons/duotune/general/gen034.svg" />
              </span>
            </div>
          </slot>
        </div>
        <!--end::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body scroll-y d-flex">
          <slot name="body"></slot>
        </div>
        <!--end::Modal body-->
        <!--begin::Modal footer-->
        <div class="modal-footer">
          <slot name="footer"></slot>
        </div>
        <!--end::Modal footer-->
      </div>
      <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
  </div>
</template>

<script setup lang="ts">
import { computed, nextTick, onMounted, onUnmounted, watch } from "vue";
import { Modal } from "bootstrap";

const props = defineProps({
  title: String,
  closable: { default: true },
  id: { type: String, required: true },
  modelValue: { required: true },
  cssClass: { type: String, default: "modal-dialog-centered mw-950px" },
});

const emits = defineEmits(["update:modelValue", "hidden"]);

let modal: Modal | undefined = undefined;
let element: HTMLElement | null = null;

watch(
  () => props.modelValue,
  (newVal, oldValue) => {
    if (!oldValue && newVal) {
      modal!.show();
    }
    if (!newVal && oldValue) {
      modal!.hide();
    }
  }
);

const backdrop_static = computed(() => {
  return props.closable ? true : "static";
});

onMounted(() => {
  nextTick(() => {
    element = document.getElementById(props.id);
    if (element) {
      modal = new Modal(element, {
        keyboard: false,
      });
      element.addEventListener("hide.bs.modal", dismiss);
      element.addEventListener("hidden.bs.modal", dismissed);
    }
  });
});

onUnmounted(() => {
  if (element) {
    element.removeEventListener("hide.bs.modal", dismiss);
    element.removeEventListener("hide.bs.modal", dismissed);
  }
});

function dismiss() {
  emits("update:modelValue", false);
}
function dismissed() {
  emits("hidden");
}
</script>

<style scoped></style>
