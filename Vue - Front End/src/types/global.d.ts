export {}

declare global {
  const Swal: {
    fire: (options: any) => Promise<any>
  }
}
