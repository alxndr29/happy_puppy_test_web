import { reactive } from "vue";

interface LoadingState {
  isLoading: boolean;
}

export const loadingState = reactive<LoadingState>({
  isLoading: false,
});

export const showLoading = (): void => {
  loadingState.isLoading = true;
};

export const hideLoading = (): void => {
  loadingState.isLoading = false;
};