import type { Profile } from "@/interfaces/profile";

export interface User {
  id: string;
  name: string;
  email: string;
  profile: Profile;
}
