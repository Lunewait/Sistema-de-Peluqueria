import React from 'react';
import { TimeSlot } from '../types';
import { Calendar, Clock } from 'lucide-react';

interface Step2Props {
  date: string | null;
  time: string | null;
  timeSlots: TimeSlot[];
  onSelectDate: (date: string) => void;
  onSelectTime: (time: string) => void;
}

const Step2Schedule: React.FC<Step2Props> = ({
  date,
  time,
  timeSlots,
  onSelectDate,
  onSelectTime,
}) => {
  // Mock generating next 7 days
  const getNextDays = () => {
    const days = [];
    const today = new Date();
    for (let i = 0; i < 5; i++) {
      const d = new Date(today);
      d.setDate(today.getDate() + i);
      days.push(d);
    }
    return days;
  };

  const days = getNextDays();

  return (
    <div className="space-y-8 animate-fade-in">
      {/* Date Selection */}
      <div>
        <h2 className="text-2xl font-semibold text-slate-800 mb-2">2. Elige el Momento</h2>
        <p className="text-slate-500 mb-6">Selecciona la fecha ideal para tu visita.</p>
        
        <div className="flex gap-4 overflow-x-auto pb-4 custom-scrollbar">
          {days.map((d) => {
            const dateStr = d.toISOString().split('T')[0];
            const isSelected = date === dateStr;
            const dayName = d.toLocaleDateString('es-ES', { weekday: 'short' });
            const dayNum = d.getDate();

            return (
              <button
                key={dateStr}
                onClick={() => onSelectDate(dateStr)}
                className={`
                  flex flex-col items-center justify-center min-w-[80px] h-24 rounded-2xl border transition-all duration-200
                  ${isSelected 
                    ? 'bg-teal-500 border-teal-500 text-white shadow-lg shadow-teal-500/30 transform scale-105' 
                    : 'bg-white border-slate-200 text-slate-600 hover:border-teal-300 hover:bg-teal-50'}
                `}
              >
                <span className="text-xs font-medium uppercase tracking-wider opacity-80">{dayName}</span>
                <span className="text-2xl font-bold">{dayNum}</span>
              </button>
            );
          })}
        </div>
      </div>

      {/* Time Slots */}
      <div className={`transition-all duration-500 ${date ? 'opacity-100' : 'opacity-40 pointer-events-none'}`}>
        <div className="flex items-center gap-2 mb-4">
          <Clock className="w-5 h-5 text-teal-500" />
          <h3 className="text-lg font-medium text-slate-700">Horarios Disponibles</h3>
        </div>
        
        {date ? (
            <div className="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
            {timeSlots.map((slot) => (
                <button
                key={slot.time}
                disabled={!slot.available}
                onClick={() => onSelectTime(slot.time)}
                className={`
                    py-2 px-4 rounded-xl text-sm font-semibold transition-all duration-200
                    ${!slot.available 
                    ? 'bg-slate-100 text-slate-400 cursor-not-allowed line-through decoration-slate-300' 
                    : time === slot.time
                        ? 'bg-teal-500 text-white shadow-md transform scale-105'
                        : 'bg-white border border-slate-200 text-slate-700 hover:border-teal-400 hover:text-teal-600'}
                `}
                >
                {slot.time}
                </button>
            ))}
            </div>
        ) : (
            <div className="p-6 bg-slate-50 rounded-2xl border border-dashed border-slate-300 text-center text-slate-400">
                <Calendar className="w-8 h-8 mx-auto mb-2 opacity-50" />
                Selecciona una fecha primero
            </div>
        )}
      </div>
    </div>
  );
};

export default Step2Schedule;