import React from 'react';

interface CodeBlockProps {
  title: string;
  code: string;
  language?: string;
}

const CodeBlock: React.FC<CodeBlockProps> = ({ title, code, language = 'php' }) => {
  return (
    <div className="rounded-2xl overflow-hidden border border-slate-200 shadow-sm bg-slate-900 text-slate-300 font-mono text-sm my-6">
      <div className="flex items-center justify-between px-4 py-2 bg-slate-800 border-b border-slate-700">
        <span className="font-semibold text-slate-100">{title}</span>
        <span className="text-xs px-2 py-1 rounded bg-slate-700 text-slate-400 uppercase">{language}</span>
      </div>
      <div className="p-4 overflow-x-auto custom-scrollbar">
        <pre className="whitespace-pre">
            <code>{code}</code>
        </pre>
      </div>
    </div>
  );
};

export default CodeBlock;