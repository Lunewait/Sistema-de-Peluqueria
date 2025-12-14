export interface Service {
  id: number;
  name: string;
  description: string;
  duration_minutes: number;
  price: number;
  image: string;
}

export interface Stylist {
  id: number;
  name: string;
  role: string;
  avatar: string;
}

export interface TimeSlot {
  time: string;
  available: boolean;
}

export interface AppointmentDraft {
  serviceId: number | null;
  stylistId: number | null;
  date: string | null;
  time: string | null;
  clientName: string;
  clientEmail: string;
  clientPhone: string;
}

export enum AppView {
  DEMO = 'DEMO',
  ARCHITECTURE = 'ARCHITECTURE'
}