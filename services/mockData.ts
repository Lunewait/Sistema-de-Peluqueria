import { Service, Stylist, TimeSlot } from '../types';

export const services: Service[] = [
  {
    id: 1,
    name: "Corte Estilizado & Lavado",
    description: "Experiencia completa de lavado relajante con masaje capilar, seguido de un corte personalizado.",
    duration_minutes: 60,
    price: 45.00,
    image: "https://picsum.photos/400/300?random=1"
  },
  {
    id: 2,
    name: "Coloración Completa",
    description: "Aplicación de tinte premium sin amoniaco para un brillo duradero y cobertura perfecta.",
    duration_minutes: 120,
    price: 85.00,
    image: "https://picsum.photos/400/300?random=2"
  },
  {
    id: 3,
    name: "Tratamiento de Keratina",
    description: "Alisado y reparación profunda para eliminar el frizz y devolver la vitalidad.",
    duration_minutes: 90,
    price: 120.00,
    image: "https://picsum.photos/400/300?random=3"
  },
  {
    id: 4,
    name: "Manicura Spa Deluxe",
    description: "Cuidado detallado de uñas y cutículas con exfoliación y masaje de manos.",
    duration_minutes: 45,
    price: 35.00,
    image: "https://picsum.photos/400/300?random=4"
  }
];

export const stylists: Stylist[] = [
  {
    id: 1,
    name: "Ana García",
    role: "Senior Stylist",
    avatar: "https://picsum.photos/100/100?random=10"
  },
  {
    id: 2,
    name: "Carlos Ruiz",
    role: "Colorist Expert",
    avatar: "https://picsum.photos/100/100?random=11"
  },
  {
    id: 3,
    name: "Elena V.",
    role: "Nail Artist",
    avatar: "https://picsum.photos/100/100?random=12"
  }
];

export const generateTimeSlots = (): TimeSlot[] => {
  const slots = [
    { time: "09:00", available: true },
    { time: "10:00", available: false }, // Booked
    { time: "11:00", available: true },
    { time: "12:00", available: true },
    { time: "13:00", available: false }, // Lunch
    { time: "14:00", available: true },
    { time: "15:00", available: true },
    { time: "16:00", available: false }, // Booked
    { time: "17:00", available: true },
  ];
  return slots;
};