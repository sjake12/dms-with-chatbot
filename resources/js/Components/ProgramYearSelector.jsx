import React from 'react';

export const ProgramSelector = ({ programs, value, onChange, error }) => (
    <div>
        <select
            value={value}
            onChange={(e) => onChange(e.target.value)}
            className="mt-1 block w-full p-2 border rounded"
        >
            {programs.map((program) => (
                <option
                    key={program.program_id}
                    value={program.program_id}
                >
                    {program.program_description}
                </option>
            ))}
        </select>
        {error && <p className="text-red-500 text-sm mt-1">{error}</p>}
    </div>
);

export const YearLevelSelector = ({ yearLevels, value, onChange, error }) => (
    <div>
        <select
            value={value}
            onChange={(e) => onChange(e.target.value)}
            className="mt-1 block w-full p-2 border rounded"
        >
            {yearLevels.map((yearLevel) => (
                <option
                    key={yearLevel.year_level_id}
                    value={yearLevel.year_level_id}
                >
                    {yearLevel.year_level}
                </option>
            ))}
        </select>
        {error && <p className="text-red-500 text-sm mt-1">{error}</p>}
    </div>
);
