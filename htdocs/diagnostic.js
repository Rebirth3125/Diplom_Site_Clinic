function navigateToDiagnostic(type) {
  switch (type) {
      case 'УЗИ':
          window.location.href = 'uzi.html';
          break;
      case 'МРТ':
          window.location.href = 'mrt.html';
          break;
      case 'КТ':
          window.location.href = 'kt.html';
          break;
      case 'РЕНТГЕН':
          window.location.href = 'xray.html';
          break;
      default:
          console.error('Unknown diagnostic type:', type);
  }
}
