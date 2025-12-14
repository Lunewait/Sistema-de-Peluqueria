import React from 'react';
import { Service, Stylist } from '../types';
import { CheckCircle } from 'lucide-react';

interface Step1Props {
  services: Service[];
  stylists: Stylist[];
  selectedServiceId: number | null;
  selectedStylistId: number | null;
  onSelectService: (id: number) => void;
  onSelectStylist: (id: number) => void;
}

const Step1Services: React.FC<Step1Props> = ({
  services,
  stylists,
  selectedServiceId,
  selectedStylistId,
  onSelectService,
  onSelectStylist,
}) => {
  return (
    <div className="space-y-8 animate-fade-in">
      {/* Services Section */}
      <div>
        <h2 className="text-2xl font-semibold text-slate-800 mb-2">1. Selecciona tu Experiencia</h2>
        <p className="text-slate-500 mb-6">Elige entre nuestros servicios premium diseñados para ti.</p>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {services.map((service) => (
            <div
              key={service.id}
              onClick={() => onSelectService(service.id)}
              className={`
                group relative p-4 rounded-3xl border-2 transition-all duration-300 cursor-pointer overflow-hidden
                ${selectedServiceId === service.id 
                  ? 'border-teal-400 bg-teal-50 shadow-lg shadow-teal-500/10' 
                  : 'border-slate-100 bg-white hover:border-teal-200 hover:shadow-md'}
              `}
            >
              <div className="flex gap-4">
                <div className="w-24 h-24 flex-shrink-0 rounded-2xl overflow-hidden bg-slate-200">
                  <img src={service.image} alt={service.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" />
                </div>
                <div className="flex-1">
                  <div className="flex justify-between items-start">
                    <h3 className="font-bold text-slate-800 text-lg">{service.name}</h3>
                    {selectedServiceId === service.id && (
                      <CheckCircle className="w-6 h-6 text-teal-500" />
                    )}
                  </div>
                  <p className="text-sm text-slate-500 mt-1 line-clamp-2">{service.description}</p>
                  <div className="mt-3 flex items-center justify-between">
                    <span className="text-xs font-medium bg-slate-100 text-slate-600 px-3 py-1 rounded-full">
                      {service.duration_minutes} min
                    </span>
                    <span className="font-bold text-teal-600 text-lg">
                      ${service.price.toFixed(2)}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>

      {/* Stylists Section */}
      <div className={`transition-opacity duration-500 ${selectedServiceId ? 'opacity-100' : 'opacity-50 pointer-events-none'}`}>
        <h2 className="text-2xl font-semibold text-slate-800 mb-2">¿Preferencia de Estilista?</h2>
        <p className="text-slate-500 mb-6">Selecciona un profesional o permite que te asignemos el mejor disponible.</p>

        <div className="flex flex-wrap gap-6">
          {/* Option: Any Stylist */}
          <div 
            onClick={() => onSelectStylist(0)}
            className={`
              flex flex-col items-center gap-3 cursor-pointer transition-transform hover:-translate-y-1
              ${selectedStylistId === 0 ? 'scale-105' : 'opacity-70 hover:opacity-100'}
            `}
          >
            <div className={`
              w-20 h-20 rounded-full flex items-center justify-center border-2 
              ${selectedStylistId === 0 ? 'border-teal-400 bg-teal-50 text-teal-600' : 'border-slate-200 bg-slate-50 text-slate-400'}
            `}>
              <span className="font-bold text-xs text-center leading-tight">Cualquiera<br/>Disponible</span>
            </div>
          </div>

          {stylists.map((stylist) => (
            <div
              key={stylist.id}
              onClick={() => onSelectStylist(stylist.id)}
              className={`
                flex flex-col items-center gap-2 cursor-pointer transition-transform hover:-translate-y-1
                ${selectedStylistId === stylist.id ? 'scale-105' : 'opacity-70 hover:opacity-100'}
              `}
            >
              <div className={`
                w-20 h-20 rounded-full overflow-hidden border-2 p-1
                ${selectedStylistId === stylist.id ? 'border-teal-400' : 'border-transparent'}
              `}>
                <img src={stylist.avatar} alt={stylist.name} className="w-full h-full rounded-full object-cover" />
              </div>
              <div className="text-center">
                <p className={`text-sm font-semibold ${selectedStylistId === stylist.id ? 'text-teal-600' : 'text-slate-700'}`}>
                  {stylist.name}
                </p>
                <p className="text-xs text-slate-400">{stylist.role}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default Step1Services;