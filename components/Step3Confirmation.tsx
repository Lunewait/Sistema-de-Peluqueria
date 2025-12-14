import React, { useState } from 'react';
import { AppointmentDraft, Service, Stylist } from '../types';
import { Calendar, Clock, Scissors, User, CreditCard, Lock } from 'lucide-react';

interface Step3Props {
  draft: AppointmentDraft;
  service: Service;
  stylist: Stylist | null;
  onConfirm: () => void;
  onUpdateClient: (field: string, value: string) => void;
}

const Step3Confirmation: React.FC<Step3Props> = ({
  draft,
  service,
  stylist,
  onConfirm,
  onUpdateClient,
}) => {
  const [isProcessing, setIsProcessing] = useState(false);

  const handleConfirm = () => {
    setIsProcessing(true);
    // Simulate network request
    setTimeout(() => {
      onConfirm();
      setIsProcessing(false);
    }, 2000);
  };

  // Calculate deposit (e.g., 20%)
  const deposit = service.price * 0.20;

  return (
    <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-fade-in">
      
      {/* Summary Card */}
      <div className="lg:col-span-1 order-2 lg:order-1">
        <div className="bg-slate-900 text-white rounded-3xl p-6 shadow-xl relative overflow-hidden">
          {/* Decorative shapes */}
          <div className="absolute top-0 right-0 w-32 h-32 bg-teal-500 rounded-full blur-3xl opacity-20 -mr-10 -mt-10"></div>
          
          <h3 className="text-xl font-semibold mb-6">Resumen de Reserva</h3>
          
          <div className="space-y-6 relative z-10">
            <div className="flex gap-4 items-start">
              <div className="bg-white/10 p-2 rounded-lg">
                <Scissors className="w-5 h-5 text-teal-400" />
              </div>
              <div>
                <p className="text-sm text-slate-400">Servicio</p>
                <p className="font-medium">{service.name}</p>
                <p className="text-xs text-slate-400 mt-1">{service.duration_minutes} minutos</p>
              </div>
            </div>

            <div className="flex gap-4 items-start">
              <div className="bg-white/10 p-2 rounded-lg">
                <User className="w-5 h-5 text-teal-400" />
              </div>
              <div>
                <p className="text-sm text-slate-400">Estilista</p>
                <p className="font-medium">{stylist ? stylist.name : "Profesional Asignado"}</p>
              </div>
            </div>

            <div className="flex gap-4 items-start">
              <div className="bg-white/10 p-2 rounded-lg">
                <Calendar className="w-5 h-5 text-teal-400" />
              </div>
              <div>
                <p className="text-sm text-slate-400">Fecha & Hora</p>
                <p className="font-medium">{draft.date} a las {draft.time}</p>
              </div>
            </div>

            <div className="border-t border-white/10 pt-4 mt-4">
              <div className="flex justify-between mb-2">
                <span className="text-slate-400">Subtotal</span>
                <span>${service.price.toFixed(2)}</span>
              </div>
              <div className="flex justify-between mb-2 text-teal-300">
                <span className="text-sm">Depósito Requerido (20%)</span>
                <span>${deposit.toFixed(2)}</span>
              </div>
              <div className="flex justify-between font-bold text-xl mt-4">
                <span>Total</span>
                <span>${service.price.toFixed(2)}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Form Area */}
      <div className="lg:col-span-2 order-1 lg:order-2">
        <h2 className="text-2xl font-semibold text-slate-800 mb-2">3. Finalizar Detalle</h2>
        <p className="text-slate-500 mb-8">Completa tus datos para asegurar tu cita.</p>

        <form className="space-y-6" onSubmit={(e) => { e.preventDefault(); handleConfirm(); }}>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div className="space-y-2">
              <label className="text-sm font-medium text-slate-700">Nombre Completo</label>
              <input 
                type="text" 
                required
                className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                placeholder="Ej. María González"
                value={draft.clientName}
                onChange={(e) => onUpdateClient('clientName', e.target.value)}
              />
            </div>
            <div className="space-y-2">
              <label className="text-sm font-medium text-slate-700">Email</label>
              <input 
                type="email" 
                required
                className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                placeholder="maria@ejemplo.com"
                value={draft.clientEmail}
                onChange={(e) => onUpdateClient('clientEmail', e.target.value)}
              />
            </div>
            <div className="space-y-2">
                <label className="text-sm font-medium text-slate-700">Teléfono</label>
                <input 
                  type="tel" 
                  required
                  className="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-teal-500 focus:ring-2 focus:ring-teal-200 outline-none transition-all"
                  placeholder="+34 600 000 000"
                  value={draft.clientPhone}
                  onChange={(e) => onUpdateClient('clientPhone', e.target.value)}
                />
            </div>
          </div>

          <div className="bg-teal-50 border border-teal-100 rounded-2xl p-6 mt-6">
            <div className="flex items-center gap-3 mb-4">
                <CreditCard className="w-5 h-5 text-teal-600" />
                <h4 className="font-semibold text-teal-900">Pago del Depósito Seguro</h4>
            </div>
            <p className="text-sm text-teal-700 mb-4">
                Para confirmar la reserva, requerimos un depósito de <strong>${deposit.toFixed(2)}</strong>. El resto se pagará en el salón.
            </p>
            
            {/* Mock Credit Card Input */}
            <div className="space-y-4">
                <input 
                    type="text" 
                    placeholder="Número de Tarjeta (Simulado)"
                    className="w-full px-4 py-3 bg-white rounded-xl border border-teal-200 focus:outline-none focus:ring-2 focus:ring-teal-300"
                    readOnly
                />
                <div className="grid grid-cols-2 gap-4">
                    <input 
                        type="text" 
                        placeholder="MM/YY"
                        className="w-full px-4 py-3 bg-white rounded-xl border border-teal-200 focus:outline-none"
                        readOnly
                    />
                    <input 
                        type="text" 
                        placeholder="CVC"
                        className="w-full px-4 py-3 bg-white rounded-xl border border-teal-200 focus:outline-none"
                        readOnly
                    />
                </div>
            </div>
          </div>

          <button 
            type="submit"
            disabled={isProcessing}
            className={`
                w-full py-4 rounded-xl font-bold text-lg text-white shadow-xl transition-all
                flex items-center justify-center gap-2
                ${isProcessing ? 'bg-slate-400 cursor-not-allowed' : 'bg-slate-900 hover:bg-teal-600 hover:shadow-teal-500/30'}
            `}
          >
            {isProcessing ? (
                <span>Procesando...</span>
            ) : (
                <>
                    <Lock className="w-5 h-5" />
                    Confirmar y Pagar ${deposit.toFixed(2)}
                </>
            )}
          </button>
        </form>
      </div>
    </div>
  );
};

export default Step3Confirmation;