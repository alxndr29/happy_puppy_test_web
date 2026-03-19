import type { AxiosResponse, AxiosError } from "axios";

type SwalOptions = {
  successTitle?: string;
  successMessage?: string;
  errorTitle?: string;
  errorMessage?: string;
};

const formatErrorMessage = (message: any): string => {
  if (Array.isArray(message)) {
    return `
      <ul style="text-align:left;padding-left:18px;margin:0;">
        ${message
          .map((m) => `<li style="margin-bottom:4px;">${m}</li>`)
          .join("")}
      </ul>
    `;
  }

  if (typeof message === "string") {
    return message;
  }

  return "Terjadi kesalahan";
};

export const swalConfirm = async (options?: {
  title?: string;
  text?: string;
  confirmText?: string;
  cancelText?: string;
}) => {
  const {
    title = "Are you sure?",
    text = "This action cannot be undone",
    confirmText = "Yes",
    cancelText = "Cancel",
  } = options || {};

  const result = await Swal.fire({
    icon: "warning",
    title,
    text,
    showCancelButton: true,
    confirmButtonText: confirmText,
    cancelButtonText: cancelText,
    reverseButtons: true,
  });

  return result.isConfirmed;
};

export const swalApiResponse = (
  responseOrError: unknown,
  options?: SwalOptions,
) => {
  const {
    successTitle = "Success",
    successMessage,
    errorTitle = "Error",
    errorMessage = "Terjadi kesalahan",
  } = options || {};

  // ================= SUCCESS CUSTOM =================
  if (successMessage) {
    return Swal.fire({
      icon: "success",
      title: successTitle,
      text: successMessage,
      showConfirmButton: true,
    });
  }

  // ================= SUCCESS FROM RESPONSE =================
  if (
    typeof responseOrError === "object" &&
    responseOrError !== null &&
    "status" in responseOrError
  ) {
    const res = responseOrError as AxiosResponse;

    if (res.status >= 200 && res.status < 300) {
      const message = res.data?.message || "Berhasil";

      return Swal.fire({
        icon: "success",
        title: successTitle,
        text: message,
        timer: 1500,
        showConfirmButton: false,
      });
    }
  }

  // ================= ERROR HANDLING =================
  let title = errorTitle;
  let html = errorMessage;

  if (typeof responseOrError === "object" && responseOrError !== null) {
    const err = responseOrError as AxiosError<any>;
    const data = err.response?.data;

    if (data) {
      const metaMessage = data.meta?.message;
      const validationErrors = data.data?.errors;

      // ✅ TITLE PRIORITAS DARI META.MESSAGE
      if (metaMessage) {
        title = metaMessage;
      } else {
        // fallback kalau meta.message tidak ada
        switch (err.response?.status) {
          case 400:
            title = "Bad Request";
            break;
          case 401:
            title = "Unauthorized";
            break;
          case 403:
            title = "Forbidden";
            break;
          case 404:
            title = "Not Found";
            break;
          case 422:
            title = "Validation Error";
            break;
          case 500:
            title = "Server Error";
            break;
        }
      }

      // ✅ HANDLE VALIDATION ERRORS (ARRAY)
      if (Array.isArray(validationErrors) && validationErrors.length > 0) {
        html = formatErrorMessage(validationErrors.map((e: any) => e.message));
      }
      // fallback lain
      else if (data.message) {
        html = data.message;
      } else {
        html = errorMessage;
      }
    }
  }

  return Swal.fire({
    icon: "error",
    title,
    html,
    confirmButtonText: "OK",
  });
};
