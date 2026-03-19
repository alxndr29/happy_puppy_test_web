export const showModal = (id: string) => {
  const el = document.getElementById(id);
  if (!el) return;

  const modal = window.bootstrap.Modal.getOrCreateInstance(el);
  modal.show();
};

export const hideModal = (id: string) => {
  const el = document.getElementById(id);
  if (!el) return;

  const modal = window.bootstrap.Modal.getOrCreateInstance(el);
  modal.hide();
};

export const toggleModal = (id: string) => {
  const el = document.getElementById(id);
  if (!el) return;

  const modal = window.bootstrap.Modal.getOrCreateInstance(el);
  modal.toggle();
};
