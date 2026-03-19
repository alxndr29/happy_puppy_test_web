export {}

declare global {
  interface Window {
    KTUtil?: {
      ready: (callback: () => void) => void
    }
  }
}
