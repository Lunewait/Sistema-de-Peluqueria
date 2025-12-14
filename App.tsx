import React, { useState } from 'react';
import { AppView, AppointmentDraft, Service, Stylist } from './types';
import { services, stylists, generateTimeSlots } from './services/mockData';
import Step1Services from './components/Step1Services';
import Step2Schedule from './components/Step2Schedule';
import Step3Confirmation from './components/Step3Confirmation';
import CodeBlock from './components/CodeBlock';
import { PHP_MIGRATIONS_CODE, PHP_MODEL_CODE } from './constants';
import { ChevronRight, ChevronLeft, CheckCircle2, Layout, Code2 } from 'lucide-react';

const App: React.FC = () => {
  const [currentView, setCurrentView] = useState<AppView>(AppView.DEMO);
  const [step, setStep] = useState(1);
  const [confirmed, setConfirmed] = useState(false);

  // Booking State
  const [draft, setDraft] = useState<AppointmentDraft>({
    serviceId: null,
    stylistId: null,
    date: null,
    time: null,
    clientName: '',
    clientEmail: '',
    clientPhone: ''
  });

  const selectedService = services.find(s => s.id === draft.serviceId) || null;
  const selectedStylist = stylists.find(s => s.id === draft.stylistId) || null;
  const timeSlots = generateTimeSlots();

  const handleNext = () => {
    if (step === 1 && draft.serviceId) setStep(2);
    if (step === 2 && draft.date && draft.time) setStep(3);
  };

  const handleBack = () => {
    if (step > 1) setStep(step - 1);
  };

  const handleConfirmBooking = () => {
    setConfirmed(true);
  };

  const updateClient = (field: string, value: string) => {
    setDraft(prev => ({ ...prev, [field]: value }));
  };

  const resetBooking = () => {
      setStep(1);
      setConfirmed(false);
      setDraft({
          serviceId: null,
          stylistId: null,
          date: null,
          time: null,
          clientName: '',
          clientEmail: '',
          clientPhone: ''
      });
  };

  // Render Content based on View
  const renderContent = () => {
    if (currentView === AppView.ARCHITECTURE) {
        return (
            <div className="max-w-4xl mx-auto animate-fade-in">
                <div className="mb-8">
                    <h2 className="text-3xl font-bold text-slate-800">Arquitectura Backend</h2>
                    <p className="text-slate-600 mt-2">Especificaciones técnicas para Laravel 10 + PostgreSQL según requerimientos.</p>
                </div>

                <div className="space-y-8">
                    <section>
                        <div className="flex items-center gap-3 mb-4">
                            <div className="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold">I</div>
                            <h3 className="text-xl font-bold text-slate-800">Estructura de Base de Datos (Migraciones)</h3>
                        </div>
                        <p className="text-slate-600 mb-4 text-sm">
                            Definición de tablas relacionales incluyendo roles, usuarios, servicios, productos, horarios y citas.
                        </p>
                        <CodeBlock title="database/migrations/2023_01_01_create_salon_tables.php" code={PHP_MIGRATIONS_CODE} />
                    </section>

                    <section>
                        <div className="flex items-center gap-3 mb-4">
                            <div className="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-600 font-bold">II</div>
                            <h3 className="text-xl font-bold text-slate-800">Lógica de Negocio (Modelo Appointment)</h3>
                        </div>
                        <p className="text-slate-600 mb-4 text-sm">
                            Modelo Eloquent con Scope personalizado <code>scopeIsOverlapping</code> para prevención de conflictos de agenda.
                        </p>
                        <CodeBlock title="app/Models/Appointment.php" code={PHP_MODEL_CODE} />
                    </section>
                </div>
            </div>
        );
    }

    // DEMO VIEW
    if (confirmed) {
        return (
            <div className="max-w-md mx-auto text-center py-20 animate-fade-in">
                <div className="w-24 h-24 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <CheckCircle2 className="w-12 h-12 text-teal-600" />
                </div>
                <h2 className="text-3xl font-bold text-slate-900 mb-4">¡Reserva Confirmada!</h2>
                <p className="text-slate-600 mb-8">
                    Gracias {draft.clientName}, hemos enviado los detalles a <strong>{draft.clientEmail}</strong>.
                    Te esperamos el {draft.date} a las {draft.time}.
                </p>
                <button 
                    onClick={resetBooking}
                    className="px-8 py-3 bg-slate-900 text-white rounded-xl hover:bg-slate-800 transition-colors shadow-lg"
                >
                    Volver al Inicio
                </button>
            </div>
        );
    }

    return (
        <div className="max-w-5xl mx-auto">
            {/* Progress Bar */}
            <div className="mb-10 px-4">
                <div className="flex items-center justify-between relative">
                    <div className="absolute left-0 top-1/2 w-full h-1 bg-slate-100 -z-10 rounded-full"></div>
                    <div 
                        className="absolute left-0 top-1/2 h-1 bg-teal-500 transition-all duration-500 -z-10 rounded-full"
                        style={{ width: step === 1 ? '0%' : step === 2 ? '50%' : '100%' }}
                    ></div>
                    
                    {[1, 2, 3].map((s) => (
                        <div key={s} className="flex flex-col items-center gap-2 bg-white px-2">
                            <div className={`
                                w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-2 transition-all duration-300
                                ${step >= s ? 'border-teal-500 bg-teal-500 text-white' : 'border-slate-200 bg-white text-slate-400'}
                            `}>
                                {s}
                            </div>
                            <span className={`text-xs font-medium uppercase tracking-wide ${step >= s ? 'text-teal-600' : 'text-slate-400'}`}>
                                {s === 1 ? 'Servicios' : s === 2 ? 'Agenda' : 'Pago'}
                            </span>
                        </div>
                    ))}
                </div>
            </div>

            {/* Step Content */}
            <div className="min-h-[400px]">
                {step === 1 && (
                    <Step1Services 
                        services={services}
                        stylists={stylists}
                        selectedServiceId={draft.serviceId}
                        selectedStylistId={draft.stylistId}
                        onSelectService={(id) => setDraft(prev => ({ ...prev, serviceId: id }))}
                        onSelectStylist={(id) => setDraft(prev => ({ ...prev, stylistId: id }))}
                    />
                )}
                {step === 2 && (
                    <Step2Schedule 
                        date={draft.date}
                        time={draft.time}
                        timeSlots={timeSlots}
                        onSelectDate={(d) => setDraft(prev => ({ ...prev, date: d, time: null }))}
                        onSelectTime={(t) => setDraft(prev => ({ ...prev, time: t }))}
                    />
                )}
                {step === 3 && selectedService && (
                    <Step3Confirmation 
                        draft={draft}
                        service={selectedService}
                        stylist={selectedStylist}
                        onConfirm={handleConfirmBooking}
                        onUpdateClient={updateClient}
                    />
                )}
            </div>

            {/* Navigation Footer */}
            <div className="mt-12 flex justify-between pt-6 border-t border-slate-100">
                <button
                    onClick={handleBack}
                    disabled={step === 1}
                    className={`
                        flex items-center gap-2 px-6 py-3 rounded-xl font-medium transition-colors
                        ${step === 1 ? 'text-slate-300 cursor-not-allowed' : 'text-slate-600 hover:bg-slate-50'}
                    `}
                >
                    <ChevronLeft className="w-5 h-5" />
                    Atrás
                </button>

                {step < 3 ? (
                    <button
                        onClick={handleNext}
                        disabled={(step === 1 && !draft.serviceId) || (step === 2 && (!draft.date || !draft.time))}
                        className={`
                            flex items-center gap-2 px-8 py-3 rounded-xl font-bold text-white shadow-lg transition-all
                            ${((step === 1 && !draft.serviceId) || (step === 2 && (!draft.date || !draft.time)))
                                ? 'bg-slate-300 shadow-none cursor-not-allowed' 
                                : 'bg-teal-500 hover:bg-teal-600 hover:shadow-teal-500/30'}
                        `}
                    >
                        Siguiente
                        <ChevronRight className="w-5 h-5" />
                    </button>
                ) : null}
            </div>
        </div>
    );
  };

  return (
    <div className="min-h-screen bg-[#F8FAFC] text-slate-800 font-sans selection:bg-teal-100 selection:text-teal-900">
      
      {/* Header */}
      <header className="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div className="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <div className="flex items-center gap-2">
                <div className="w-8 h-8 bg-slate-900 rounded-lg flex items-center justify-center">
                    <span className="text-teal-400 font-bold text-xl">L</span>
                </div>
                <span className="text-xl font-bold tracking-tight text-slate-900">Lumina<span className="text-teal-500">.</span></span>
            </div>

            <nav className="flex items-center bg-slate-100 p-1 rounded-xl">
                <button
                    onClick={() => setCurrentView(AppView.DEMO)}
                    className={`
                        flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all
                        ${currentView === AppView.DEMO ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'}
                    `}
                >
                    <Layout className="w-4 h-4" />
                    Live Demo
                </button>
                <button
                    onClick={() => setCurrentView(AppView.ARCHITECTURE)}
                    className={`
                        flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-all
                        ${currentView === AppView.ARCHITECTURE ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:text-slate-700'}
                    `}
                >
                    <Code2 className="w-4 h-4" />
                    Architecture
                </button>
            </nav>
        </div>
      </header>

      {/* Main Content */}
      <main className="max-w-6xl mx-auto px-4 py-12">
        {renderContent()}
      </main>

    </div>
  );
};

export default App;