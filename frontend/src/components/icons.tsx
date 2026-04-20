import type { PropsWithChildren } from "react";

type IconProps = {
  className?: string;
};

function SvgWrapper({
  children,
  className,
}: PropsWithChildren<IconProps>) {
  return (
    <svg
      viewBox="0 0 24 24"
      fill="none"
      stroke="currentColor"
      strokeWidth="1.8"
      strokeLinecap="round"
      strokeLinejoin="round"
      className={className}
      aria-hidden="true"
    >
      {children}
    </svg>
  );
}

export function ArrowRightIcon({ className }: IconProps) {
  return (
    <SvgWrapper className={className}>
      <path d="M5 12h14" />
      <path d="m13 6 6 6-6 6" />
    </SvgWrapper>
  );
}

export function ShieldIcon({ className }: IconProps) {
  return (
    <SvgWrapper className={className}>
      <path d="M12 3 5 6v5c0 5 3.4 8.8 7 10 3.6-1.2 7-5 7-10V6l-7-3Z" />
      <path d="m9.5 12 1.8 1.8 3.7-4.1" />
    </SvgWrapper>
  );
}

export function GraduationCapIcon({ className }: IconProps) {
  return (
    <SvgWrapper className={className}>
      <path d="m3 9 9-4 9 4-9 4-9-4Z" />
      <path d="M7 11v4.5c0 1.6 2.3 3 5 3s5-1.4 5-3V11" />
      <path d="M21 10v6" />
    </SvgWrapper>
  );
}

export function SparkIcon({ className }: IconProps) {
  return (
    <SvgWrapper className={className}>
      <path d="m12 3 1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8L12 3Z" />
    </SvgWrapper>
  );
}
